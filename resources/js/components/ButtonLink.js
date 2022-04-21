import React from 'react'
import styled from 'styled-components'
import { Link } from 'react-router-dom'
import { buttonStyle } from './forms/Button'

const ButtonLink = ({ fullWidth, ...props }) => {
  return <Link {...props} />
}

const StyledButtonLink = styled(ButtonLink)`${buttonStyle}`

export default StyledButtonLink
