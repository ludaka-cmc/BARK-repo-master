import React, { useState, useEffect, createContext } from 'react'
import PropTypes from 'prop-types'
import { getUser, verifyAuth } from '../helpers/auth'
import Gigya from '../helpers/Gigya'

const {
  Provider,
  Consumer: UserConsumer
} = createContext(getUser())

/**
 * Wrapper for UserProvider
 *
 * This component will automatically retrieve and update the user state. The
 * user state will be passed to UserConsumers as `{ user: <userData> }`
 */
const UserProvider = ({ children }) => {
  const [user, setUser] = useState(getUser())
  const [verified, setVerified] = useState(null)

  useEffect(() => {
    Gigya.initialize(user => {
      setUser(user)
      setVerified(true)
    })

    verifyAuth().then(verified => {
      setVerified(verified)

      if (user && !verified) {
        Gigya.showModal()
        setUser(false)
      }
    })
  }, [])

  return (
    <Provider value={{ user: { verified: verified, data: user } }}>
      {children}
    </Provider>
  )
}

UserProvider.propTypes = {
  children: PropTypes.oneOfType([PropTypes.func, PropTypes.node])
}

export { UserProvider, UserConsumer }
