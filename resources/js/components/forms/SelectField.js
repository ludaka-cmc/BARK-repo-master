import React, { Component } from 'react'
import Select from 'react-select'
import Label from './Label'
import theme from '../../helpers/theme'

const selectStyles = {
  control: (styles, { isFocused }) => {
    const outline = isFocused
      ? { boxShadow: `0 0 1px 1px ${theme.colors.akcBrightBlue}` }
      : {}

    return ({
      ...styles,
      ...outline,
      height: '38px',
      width: '100%',
      border: `1px solid ${theme.colors.akcBrightBlue}`,
      transition: 'box-shadow .250s ease-out'
    })
  },
  menu: styles => ({
    ...styles,
    marginTop: '-4px',
    borderTopLeftRadius: 0,
    borderTopRightRadius: 0
  }),
  input: styles => ({ ...styles, color: theme.colors.akcBlue }),
  placeholder: styles => ({
    ...styles,
    color: theme.colors.pepper,
    fontStyle: 'italic'
  })
}

class SelectField extends Component {
  render () {
    const { input: { name, ...input }, meta, label, ...props } = this.props
    const labelProps = meta.error && meta.touched
      ? { status: 'error', statusText: meta.error }
      : {}

    return (
      <div>
        <Label htmlFor={name} {...labelProps}>{label}</Label>
        <Select
          name={name}
          inputId={name}
          {...input}
          {...props}
          styles={selectStyles}
          searchable
        />
      </div>
    )
  }
}

export { selectStyles }

export default SelectField
