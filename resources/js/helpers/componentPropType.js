import { isValidElementType } from 'react-is'

const componentPropType = (props, propName) => {
  if (props[propName] && !isValidElementType(props[propName])) {
    return new Error(
      `Invalid prop 'component' supplied to 'Route': the prop is not a valid React component`
    )
  }
}

export default componentPropType
