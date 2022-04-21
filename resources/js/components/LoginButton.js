import React from 'react'
import styled from 'styled-components'
import { isEmpty } from 'lodash'
import Gigya from '../helpers/Gigya'
import media from '../helpers/media'
import Card from './Card'
import LoginPlaceholder from './placeholders/LoginPlaceholder'
import Tooltip from './Tooltip'

const Button = styled.span`
  ${props => props.theme.typography.latoBold};

  font-size: 14px;
  border-radius: 4px;
  border-width: 0px;
  color: ${props => props.theme.colors.akcA11yBlue};
  cursor: pointer;

  :hover, :active, :focus {
    color: ${props => props.theme.colors.akcBrightBlue};
  }
`

const HeaderButton = styled(Button)`
  width: 100%;
  margin-right: 15px;

  ${media.large`
    margin-right: 32px;
  `}
`

const LogoutCard = styled(Card)`
  box-shadow: 0 2px 6px 0 rgba(0,0,0,0.5);
`

const LogoutButton = () => {
  return (
    <Button onClick={() => Gigya.logout()}>
      Sign out
    </Button>
  )
}

const LoginButton = ({ user, tooltipSignout }) => {
  return user.verified === null
    ? (
      <LoginPlaceholder />
    ) : !user.verified || isEmpty(user.data)
      ? (
        <HeaderButton onClick={() => Gigya.showModal()}>Sign In</HeaderButton>
      ) : tooltipSignout
        ? (
          <Tooltip
            placement='bottom'
            pointContent={(
              <HeaderButton onClick={() => Gigya.showModal()}>
                Hi, {user.data.name}
              </HeaderButton>
            )}
            tooltipContent={(
              <LogoutCard>
                <LogoutButton />
              </LogoutCard>
            )}
          />
        ) : (
          <LogoutButton />
        )
}

export default LoginButton
