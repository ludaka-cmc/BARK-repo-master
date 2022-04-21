import React from 'react'
import Input from './InputField'

const HoursField = props => (
  <Input
    mask={[/\d/, '.', /\d/, /\d/, ' Hours']}
    {...props}
  />
)

export default HoursField
