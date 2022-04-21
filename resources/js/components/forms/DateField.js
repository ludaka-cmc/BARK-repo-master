import React from 'react'
import Input from './InputField'

const DateField = props => (
  <Input
    mask={[/\d/, /\d/, '/', /\d/, /\d/, '/', /\d/, /\d/, /\d/, /\d/]}
    {...props}
  />
)

export default DateField
