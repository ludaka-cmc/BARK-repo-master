import { FORM_ERROR } from 'final-form'
import { forIn, head, isEmpty, matches } from 'lodash'
import store from './store'
import http from './http'
import { fromNow } from './time'

const apiAuthStoreKey = 'apiAuth'
const apiAuthStore = store.namespace(apiAuthStoreKey)
const apiStore = store.namespace('api')

const getMilestones = (hours, expireTime) => {
  const cacheKey = `milestones-${hours}`

  return get(`/api/milestones/${hours}`, {
    cacheKey: cacheKey,
    expireTime: expireTime
  })
}

const getLogs = (logType, userId, expireTime) => {
  const cacheKey = `logs-${logType}-${userId}`

  return get(`/api/logs/${logType}/${userId}`, {
    cacheKey: cacheKey,
    expireTime: expireTime
  })
}

const getPages = (title, expireTime) => {
  const cacheKey = `pages-${title}`

  return get(`/api/pages`, {
    cacheKey: cacheKey,
    expireTime: expireTime,
    filter: pages => head(pages.filter(matches({ title: title })))
  })
}

const getTextblocks = (pageId, expireTime) => {
  const cacheKey = `textblocks-${pageId}`

  return get(`/api/textblocks`, {
    cacheKey: cacheKey,
    expireTime: expireTime,
    filter: textblocks => textblocks.filter(matches({ page_id: pageId }))
  })
}

const getVolunteers = (userId, expireTime) => {
  const cacheKey = `volunteers-${userId}`

  return get(`/api/volunteers/user/${userId}`, {
    cacheKey: cacheKey,
    expireTime: expireTime,
    filter: volunteers => {
      const volunteer = volunteers.filter(matches({ user_id: userId }))

      if (isEmpty(volunteer)) return volunteer

      return head(volunteer)
    }
  })
}

const getCertifications = (expireTime) => {
  const cacheKey = 'certifications'

  return get('/api/certifications', {
    cacheKey: cacheKey,
    expireTime: expireTime
  })
}

const getLocations = (expireTime) => {
  const cacheKey = 'locations'

  return get('/api/locations', {
    cacheKey: cacheKey,
    expireTime: expireTime
  })
}

const getStudentAges = (expireTime) => {
  const cacheKey = 'studentages'

  return get('/api/studentages', {
    cacheKey: cacheKey,
    expireTime: expireTime
  })
}

const getStudentNums = (expireTime) => {
  const cacheKey = 'studentnums'

  return get('/api/studentnums', {
    cacheKey: cacheKey,
    expireTime: expireTime
  })
}

const get = async (endpoint, { cacheKey, expireTime, filter, clearOnAuth }) => {
  const store = clearOnAuth ? apiAuthStore : apiStore

  if (cacheKey) {
    const cachedData = store.get(cacheKey)

    if (cachedData) return Promise.resolve(cachedData)
  }

  try {
    const { data } = await http.get(endpoint)

    const finalData = filter ? filter(data) : data

    if (isEmpty(finalData)) return finalData

    if (cacheKey && expireTime) {
      store.set(cacheKey, finalData, fromNow(expireTime))
    } else {
      store.set(cacheKey, finalData)
    }

    return finalData
  } catch (error) {
    console.error(error)
    return Promise.reject(error)
  }
}

const postMultipart = (endpoint, data) => {
  const formData = new window.FormData()
  const headers = {
    headers: { 'content-type': 'multipart/form-data' }
  }

  forIn(data, (value, key) => {
    formData.append(
      key,
      value instanceof window.File ? value : JSON.stringify(value)
    )
  })

  return post(endpoint, formData, headers)
}

const post = (endpoint, data, headers = {}) => {
  return http.post(endpoint, data, headers).then(response =>
    response.data.success
      ? response
      : Promise.reject(response)
  )
}

const handleSubmitError = errorMessages => error => {
  if (
    error.response.status !== 400 &&
    !errorMessages[error.response.data.error_code]
  ) {
    console.error(error)
    return { [FORM_ERROR]: 'Submission failed' }
  }

  return {
    ...errorMessages[error.response.data.error_code],
    [FORM_ERROR]: 'Submission failed, please fix error in the fields above'
  }
}

const dataToOptions = (data, cb) => data.map(value => {
  const { id, description } = value

  const option = {
    value: typeof id === 'string' ? id : `${id}`,
    label: description
  }

  return cb ? cb(option, value) : option
})

export {
  apiAuthStoreKey,
  getMilestones,
  getLogs,
  getPages,
  getTextblocks,
  getVolunteers,
  getCertifications,
  getLocations,
  getStudentAges,
  getStudentNums,
  dataToOptions,
  postMultipart,
  post,
  handleSubmitError
}
