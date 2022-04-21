import React, { Component } from 'react'
import { Async as AsyncSelect } from 'react-select'
import http from '../../helpers/http'
import store from '../../helpers/store'
import { day } from '../../helpers/time'
import Label from './Label'
import { selectStyles } from './SelectField'

class AsyncSelectField extends Component {
  constructor () {
    super()
    this.createInputHandler = this.createInputHandler.bind(this)
    this.store = store.namespace('asyncSelect')
  }

  filterOptions (options, text) {
    return options.filter(i =>
      i.label.toLowerCase().includes(text.toLowerCase())
    )
  }

  fetchOptions ({ url, cacheKey, cacheTime, optionMapper }, inputValue = '') {
    const cachedOptions = this.store.get(cacheKey)

    if (cachedOptions) {
      return Promise.resolve(
        this.filterOptions(cachedOptions, inputValue)
      )
    }

    return http(url)
      .then(({ data }) => {
        const options = optionMapper(data)
        const now = new Date().getTime()
        const expireTime = cacheTime
          ? now + cacheTime
          : now + day

        this.store.set(cacheKey, options, expireTime)

        return this.filterOptions(options, inputValue)
      })
      .catch(error => {
        console.error(error)
        return Promise.resolve(null)
      })
  }

  createInputHandler (request) {
    return inputValue => this.fetchOptions(request, inputValue)
  }

  render () {
    const {
      input: { name, ...input },
      meta,
      label,
      request,
      ...props
    } = this.props

    const labelProps = meta.error && meta.touched
      ? { status: 'error', statusText: meta.error }
      : {}

    return (
      <div>
        <Label htmlFor={name} {...labelProps}>{label}</Label>
        <AsyncSelect
          name={name}
          inputId={name}
          {...input}
          {...props}
          styles={selectStyles}
          defaultOptions
          loadOptions={this.createInputHandler(request)}
          searchable
        />
      </div>
    )
  }
}

export { selectStyles }

export default AsyncSelectField
