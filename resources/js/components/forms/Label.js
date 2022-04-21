import React from 'react'
import styled from 'styled-components'

const Status = styled.span`
  margin-left: 8px;
  color: ${props => (
    props.status === 'error'
      ? props.theme.colors.failure
      : props.theme.colors[props.status]
  )}
`

const StyledLabel = styled.label`
  font-weight: 700;
  font-size: 14px;
  color: ${props => props.theme.colors.akcBlue};
  text-transform: uppercase;
  margin-left: 4px;
  margin-bottom: 0px;
`

const Label = ({ children, status, statusText, ...props }) => (
  <StyledLabel {...props}>
    {children}
    {status && statusText && <Status status={status}>{statusText}</Status>}
  </StyledLabel>
)

export default Label
