import { isEmpty } from 'lodash'
import http from './http'
import store from './store'
import { apiAuthStoreKey } from './api'

const authStoreKey = 'auth'
const authStore = store.namespace(authStoreKey)

const getAccessToken = () => authStore.get('accessToken')

const getUser = () => authStore.get('user')

const login = async (userData, stateUpdater) => {
  const { data } = await http.post('/login', userData)

  if (isEmpty(data.token) && isEmpty(data.user)) {
    return Promise.reject(new Error('Empty token or user'))
  }

  store.clearAll(apiAuthStoreKey)

  authStore.set('accessToken', data.token)
  authStore.set('user', data.user)

  stateUpdater(getUser())
}

const logout = async (stateUpdater) => {
  if (!getAccessToken()) return Promise.resolve(true)

  try {
    await http.post('/logout')

    store.clearAll(authStoreKey)
    store.clearAll(apiAuthStoreKey)

    stateUpdater(false)

    window.location.reload()
  } catch (error) {
    return Promise.reject(error)
  }
}

const verifyAuth = async () => {
  if (!getAccessToken()) return Promise.resolve(false)

  try {
    const { data: { verified } } = await http.get('/api/verify')

    if (!verified) authStore.clearAll()

    return verified
  } catch (error) {
    console.error(error)
    return Promise.reject(error)
  }
}

export { getAccessToken, getUser, login, logout, verifyAuth }
