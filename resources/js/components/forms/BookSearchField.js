import React, { Component } from 'react'
import debounce from 'debounce-promise'
import axios from 'axios'
import store from 'store'
import Label from './Label'
import { Async as AsyncSelect } from 'react-select'
import { selectStyles } from './SelectField'

class BookSearchField extends Component {
  constructor () {
    super()
    this.handleSelectLoad = this.handleSelectLoad.bind(this)
    this.fetchBooks = debounce(this.fetchBooks, 500)
  }

  store = store.namespace('bookSearch')

  lastSearchTerm = ''

  async fetchBooks (inputValue) {
    const cachedOptions = store.get(inputValue)

    if (cachedOptions) return cachedOptions

    try {
      const { status, data } = await axios.get(
        'https://www.googleapis.com/books/v1/volumes',
        { params: { q: inputValue } }
      )

      if (status !== 200 && inputValue !== this.lastSearchTerm) {
        return null
      }

      const options = data.items.map(
        ({ id, volumeInfo: { title, authors } }) => (
          {
            value: id,
            label: `${title} by ${
              authors ? authors.join(', ') : 'Unknown Author'
            }`,
            title: title,
            authors: authors || []
          }
        )
      )

      store.set(inputValue, options)

      return options
    } catch (error) {
      console.error(error)
      return Promise.reject(error)
    }
  }

  handleSelectLoad (inputValue) {
    const searchTerm = inputValue.trim().toLowerCase()

    if (!searchTerm) return Promise.resolve(null)

    this.lastSearchTerm = searchTerm

    return this.fetchBooks(searchTerm)
  }

  render () {
    const { input: { name, ...input }, meta, label, ...props } = this.props
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
          blurInputOnSelect
          captureMenuScroll
          filterOption={null}
          loadOptions={this.handleSelectLoad}
        />
      </div>
    )
  }
}

export { selectStyles }

export default BookSearchField
