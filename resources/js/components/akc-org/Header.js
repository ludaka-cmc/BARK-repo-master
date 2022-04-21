import React, { useState, useEffect } from 'react'
import { Portal } from 'react-portal'
import AKCOrgComponent from './AKCOrgComponent'
import HeaderPlaceholder from '../placeholders/HeaderPlaceholder'
import { UserConsumer } from '../User'
import LoginButton from '../LoginButton'
import { clearChildren } from '../../helpers/DOM'

const Header = () => {
  const [bootstrapped, setBootstrapped] = useState(false)
  const [DOMHeader, setDOMHeader] = useState(null)
  const [DOMLoginButton, setDOMLoginButton] = useState(null)
  // const [DOMMobileButtons, setDOMMobileButtons] = useState(null)

  useEffect(() => {
    // Gigya's JS API does not have clean up support. Using state to enforce
    // that Gigya only be bootstrapped once to avoid memory leaks.
    if (DOMHeader && !bootstrapped) {
      setBootstrapped(true)

      const loginButton = DOMHeader.querySelector('.sign-in-nav')
      clearChildren(loginButton)
      setDOMLoginButton(loginButton)

      // Disable mobileButtons since they are not compatible with BARK's
      // mobile login components
      // const mobileButtons = DOMHeader.querySelector('.site-menu__header')
      // clearChildren(mobileButtons)
      // setDOMMobileButtons(mobileButtons)
    }
  }, [DOMHeader])

  return (
    <div>
      <AKCOrgComponent
        componentName='header'
        ContainerEl='div'
        Placeholder={HeaderPlaceholder}
        setRef={setDOMHeader}
      />
      <UserConsumer>
        {({ user }) => {
          return (
            <div>
              {
                DOMLoginButton && (
                  <Portal node={DOMLoginButton}>
                    <LoginButton user={user} tooltipSignout />
                  </Portal>
                )
              }
              {/* {
                DOMMobileButtons && (
                  <Portal node={DOMMobileButtons}>
                    <LoginButton user={user} />
                  </Portal>
                )
              } */}
            </div>
          )
        }}
      </UserConsumer>
    </div>
  )
}

export default Header
