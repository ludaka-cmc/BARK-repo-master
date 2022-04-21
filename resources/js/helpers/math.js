const mode = array => {
  if (!array.length) return null

  let counts = {}
  let currentMode = array[0]
  let highestCount = 0

  array.forEach(val => {
    if (counts[val] == null) {
      counts[val] = 1
    } else {
      counts[val]++
    }

    if (counts[val] > highestCount) {
      currentMode = val
      highestCount = counts[val]
    }
  })

  return currentMode
}

export { mode }
