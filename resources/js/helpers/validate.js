/**
 * Checks if the field has any value
 * @param {string} value
 * @returns {string|void} Undefined if true, string error message if false
 */
const required = value => (value ? undefined : 'Required')

/**
 * Returns a function that checks the value against the passed `minLength`
 * @param {string} minLength
 * @returns {function(string): string|void} validator
 */
const maskedMinLength = minLength => value => !value
  ? 'Required'
  : value.replace(/_/g, '').length < minLength
    ? 'Incomplete Entry'
    : undefined

/**
 * Checks if the date string is a valid date
 * @param {string} dateStr
 * @returns {string|void} Undefined if true, string error message if false
 */
const validDate = dateStr => {
  if (typeof dateStr !== 'string') return

  const [month, day, year] = dateStr.split('/')
  const date = new Date(`${year}-${month}-${day}`)

  return !(date instanceof Date) || isNaN(date.getDate())
    ? 'Invalid Date'
    : undefined
}

/**
 * Checks if the date string is a valid birthday
 * @param {string} dateStr
 * @returns {string|void} Undefined if true, string error message if false
 */
const validBirthday = dateStr => {
  if (typeof dateStr !== 'string') return

  const [month, day, year] = dateStr.split('/')
  const birthday = new Date(`${year}-${month}-${day}`)

  return birthday > new Date()
    ? 'Invalid Birthday'
    : undefined
}

/**
 * Composes a set of validators into one validator function. When ran, if a
 * validator fails, the following validators are skipped and that error message
 * will be returned.
 * @param {function[]} validators
 * @returns {function(string): string|void} validator
 */
const composeValidators = validators => value => {
  return validators.reduce((result, validate) => {
    if (result !== undefined) return result
    return validate(value)
  }, undefined)
}

export {
  required,
  maskedMinLength,
  validBirthday,
  validDate,
  composeValidators
}
