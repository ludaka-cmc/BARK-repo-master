import React from 'react'
import styled, { css } from 'styled-components'
import media from '../../helpers/media'

const buttonStyle = css`
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: ${props => props.theme.colors.akcBrightBlue};
  color: ${props => props.theme.colors.white};
  padding: 10px 16px;
  font-size: 13px;
  text-transform: uppercase;
  transition: background-color .250s ease-out, border-color .250s ease-out, color .250s ease-out;

  ${props => props.fullWidth && 'width: 100%; text-align: center;'};

  :hover {
    color: ${props => props.theme.colors.white};
    background-color: ${props => props.theme.colors.akcDarkBlue}
  }

  :disabled {
    opacity: 0.4;
  }

  ${media.medium`
    font-size: 16px;
    padding: 11px 32px;
  `}
`

const Button = ({ fullWidth, ...props }) => {
  return <button {...props} />
}

const StyledButton = styled(Button).attrs(props => ({
  type: 'submit'
}))`${buttonStyle}`

export { buttonStyle }

export default StyledButton
