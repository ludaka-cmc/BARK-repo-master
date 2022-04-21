const clearChildren = parent => {
  [...parent.children].forEach(child => child.remove())
}

export { clearChildren }
