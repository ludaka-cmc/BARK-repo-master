/**
 * Fire a callback when the user clicks outside of an element
 * @param {*} selector Element selector
 * @param {*} cb Callback to fire
 */
const onClickOut = (selector, cb) => {
  const outClickListener = evt => {
    if (evt.target.closest(selector) !== null) {
      return
    }

    document.removeEventListener('click', outClickListener)
    cb()
  }

  document.addEventListener('click', outClickListener)
}

export { onClickOut }
