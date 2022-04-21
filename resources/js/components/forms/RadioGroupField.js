import React from 'react'
import styled from 'styled-components'
import { Field } from 'react-final-form'
import Label from './Label'

const RadioGroupContainer = styled.div`
  display: flex;
  flex-direction: column;
`

const RadioLabel = styled.label`
  vertical-align: top;
`

const RadioText = styled.span`
  line-height: 1.1;
  margin-left: 10px;
  color: ${props => props.theme.colors.pepper};
`

const RadioGroupField = ({ name, options, label, ...props }) => {
  return (
    <div>
      <Label>{label}</Label>
      <RadioGroupContainer {...props}>
        {
          options.map((option) => (
            <RadioLabel htmlFor={name} key={option.value}>
              <Field
                name={name}
                id={name}
                type='radio'
                component='input'
                value={option.value}
              />
              <RadioText>{option.label}</RadioText>
            </RadioLabel>
          ))
        }
      </RadioGroupContainer>
    </div>
  )
}

export default RadioGroupField
