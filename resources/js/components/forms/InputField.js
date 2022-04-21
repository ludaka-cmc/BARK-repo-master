import React from 'react'
import styled, { css } from 'styled-components'
import MaskedInput from 'react-text-mask'
import Label from './Label'

const inputStyles = css`
  height: 38px;
  width: 100%;
  color: ${props => props.theme.colors.akcBlue};
  border: 1px solid ${props => props.theme.colors.akcBrightBlue};
  border-radius: 4px;
  padding: 0 8px;
  transition: box-shadow .250s ease-out;

  :focus {
    box-shadow: 0 0 1px 1px ${props => props.theme.colors.akcBrightBlue};
  }

  :disabled {
    background-color: ${props => props.theme.colors.shadow}
  }

  ::placeholder {
    color: ${props => props.theme.colors.pepper}
    margin: 0 8px;
  }
`

const StyledMaskedInput = styled(MaskedInput)`${inputStyles}`

const StyledInput = styled.input`${inputStyles}`

const InputContainer = ({
  input: { name, ...input },
  meta,
  label,
  mask,
  ...props
}) => {
  const Input = mask ? StyledMaskedInput : StyledInput
  const labelProps = (meta.error && meta.touched) || (meta.submitError)
    ? { status: 'error', statusText: meta.error || meta.submitError }
    : {}

  return (
    <div>
      <Label htmlFor={name} {...labelProps}>{label}</Label>
      <Input name={name} id={name} mask={mask} {...input} {...props} />
    </div>
  )
}

export { inputStyles }

export default InputContainer
