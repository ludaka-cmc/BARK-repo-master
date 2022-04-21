import React from 'react'
import styled from 'styled-components'
import { isEmpty } from 'lodash'
import { Redirect, Route } from 'react-router-dom'
import { UserConsumer } from './User'
import componentPropType from '../helpers/componentPropType'
import Modal from '../components/Modal'
import { Portal } from 'react-portal'

const White = styled.p`
  font-size: 24px;
  color: ${props => props.theme.colors.white};
`

const Loading = () => (
  <Portal>
    <Modal>
      <White>Loading...</White>
    </Modal>
  </Portal>
)

const ProtectedRoute = ({ component: Component, ...props }) => {
  return (
    <UserConsumer>
      {({ user }) => (
        <Route
          {...props}
          render={props => isEmpty(user.data)
            ? (<Redirect to='/' />)
            : (
              <div>
                <Component {...props} user={user} />
                {
                  user.verified === null
                    ? (<Loading />)
                    : !user.verified && (<Redirect to='/' />)
                }
              </div>
            )
          }
        />
      )}
    </UserConsumer>
  )
}

ProtectedRoute.propTypes = {
  component: componentPropType
}

export default ProtectedRoute
