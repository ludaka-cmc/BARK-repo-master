import React from 'react'
import { Field } from 'react-final-form'

const Condition = ({ when, is, children }) => (
  <Field name={when} subscription={{ value: true }}>
    {({ input: { value } }) => (value === is ? children : null)}
  </Field>
)

const AgeCondition = ({ when, is, unless, children }) => (
  <Field name={when} subscription={{ value: true }}>
    {
      ({ input: { value } }) => {
        if (value.replace(/_/g, '').length !== 10) return unless ? children : null

        const birthday = new Date(value)
        const dateDiff = new Date(Date.now() - birthday)
        const age = dateDiff.getUTCFullYear() - 1970

        if (is) {
          return is(age) ? children : null
        } else if (unless) {
          return unless(age) ? null : children
        }
      }
    }
  </Field>
)

export { Condition, AgeCondition }
