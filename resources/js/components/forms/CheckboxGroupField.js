import React, { Component } from 'react'
import styled from 'styled-components'
import { Field } from 'react-final-form'
import Label from './Label'
import CheckboxField from './CheckboxField'

const CheckboxList = styled.div`
  > label {
    display: block;
  }

  > *:not(:last-child) {
    margin-bottom: 8px;
  }
`

class CheckboxGroupField extends Component {
  render () {
    const { name, label, defaultFields } = this.props

    return (
      <CheckboxList>
        <Label>{label}</Label>
        {
          defaultFields.map(({ value, label, tooltip }, id) => (
            <Field
              key={value}
              value={value}
              name={name}
              type='checkbox'
              component={CheckboxField}
              label={label}
              tooltip={tooltip && {
                id: `tooltip-${name}-${id}`,
                ...tooltip
              }}
            />
          ))
        }
      </CheckboxList>
    )
  }
}

export default CheckboxGroupField
