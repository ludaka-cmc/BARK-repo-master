import store from 'store'
import expire from 'store/plugins/expire'

/**
 * clearNamespace plugin for store-js
 *
 * Note that plugins must be declared as a function (not callback) since `this`
 * will not be passed down otherwise
 */
function clearNamespace () {
  /**
   * Namespace is never saved to `this` and must be passed through the method
   * call.
   *
   * @param {function} superFn - default clearAll passed by storeEngine
   * @param {string} namespace - clear all values using this namespace
   */
  function clearAll (superFn, namespace = '') {
    const self = this

    if (namespace) {
      self.each((val, key) => {
        if (key.includes(`_${namespace}_`)) self.remove(key)
      })
    } else if (typeof superFn === 'function') {
      superFn()
    }
  }

  return {
    clearAll: clearAll
  }
}

store.addPlugin(expire)
store.addPlugin(clearNamespace)

export default store
