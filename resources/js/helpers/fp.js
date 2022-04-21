const compose = (...funcs) => value =>
  funcs.reduceRight((valueAcc, func) => func(valueAcc), value)

const pipe = (...funcs) => value =>
  funcs.reduce((valueAcc, func) => func(valueAcc), value)

export { compose, pipe }
