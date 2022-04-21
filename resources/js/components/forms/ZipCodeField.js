import React from 'react'
import Input from './InputField'

const ZipCodeField = props => (
  <Input
    mask={[/\d/, /\d/, /\d/, /\d/, /\d/]}
    guide={false}
    {...props}
  />
)

export default ZipCodeField
