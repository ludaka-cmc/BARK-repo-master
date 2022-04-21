import React from 'react'
import styled from 'styled-components'
import check from '../../../svg/icon-form-check.svg'
import Label from './Label'
import Tooltip from '../Tooltip'

const CheckboxLabel = styled(Label)`
  display: flex;
  align-items: center;
  cursor: pointer;
  margin: 0;
`

const CheckboxInput = styled.input.attrs(props => ({
  className: 'checkbox',
  type: 'checkbox'
}))`
  && {
    position: absolute;
    opacity: 0;
  }
`

const CheckboxBox = styled.div`
  display: flex;
  position: relative;
  padding-right: 6px;

  &::before,
  &::after {
    content: '';
    display: flex;
  }

  &::before {
    content: '';
    height: 22px;
    width: 22px;

    border: 2px solid ${props => props.theme.colors.akcBrightBlue};
    border-radius: 4px;
    left: 0px;
    top: -3px;
  }

  &::after {
    position: absolute;
    top: 5.5px;
    left: 5.5px;
    background-image: url(${check});
    background-repeat: no-repeat;
    background-size: contain;
    width: 15px;
    height: 15px;
  }

  ${CheckboxInput} + &::after {
    content: none;
  }

  ${CheckboxInput}:checked + &::after {
    content: '';
  }

  ${CheckboxInput}:focus + &::before {
    // There is no standard declaration for -*-focus-ring-color, all must be
    // explicitly declared
    outline: -webkit-focus-ring-color auto 5px;
    outline: -moz-focus-ring-color auto 5px;
    outline: -o-focus-ring-color auto 5px;
    outline: -ms-focus-ring-color auto 5px;
  }
`

const TooltipContainer = styled.div`
  display: inline-block;
  margin-left: 4px;
  vertical-align: bottom;
`

const CheckboxField = ({
  input: { name, ...input },
  meta,
  label,
  tooltip,
  ...props
}) => {
  const labelProps = meta.error && meta.touched
    ? { status: 'error', statusText: meta.error }
    : null

  return (
    <div>
      <CheckboxLabel {...labelProps}>
        <CheckboxInput type='checkbox' {...input} {...props} />
        <CheckboxBox />
        {label}
        {tooltip && (
          <TooltipContainer>
            <Tooltip {...tooltip} />
          </TooltipContainer>
        )}
      </CheckboxLabel>
    </div>
  )
}

export default CheckboxField
