import { css } from 'styled-components'

const sizes = {
  formLayout: 650,
  small: 768,
  logLayout: 960,
  medium: 1024,
  large: 1280,
  xlarge: 1400
}

const media = Object.keys(sizes).reduce((acc, label) => {
  acc[label] = (...args) => css`
    @media (min-width: ${sizes[label]}px) {
      ${css(...args)}
    }
  `

  return acc
}, {})

export default media
