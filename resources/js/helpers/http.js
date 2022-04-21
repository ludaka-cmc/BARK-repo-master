import axios from 'axios'
import { getAccessToken } from './auth'
import { second } from './time'

let http = axios.create({
  timeout: second * 10
})

http.interceptors.request.use(
  config => {
    const token = getAccessToken()

    if (!token) return config

    config.headers.Authorization = `Bearer ${token}`

    return config
  },
  error => Promise.reject(error)
)

export default http
