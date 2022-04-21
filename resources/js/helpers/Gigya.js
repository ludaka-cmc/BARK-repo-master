import { login, logout } from './auth'

class Gigya {
  static instance

  static async getInstance () {
    if (this.instance) return Promise.resolve(this.instance)

    this.instance = await this.getGigyaScriptObject()

    return Promise.resolve(this.instance)
  }

  /**
   * Initializes the Gigya `onLogin` and `onLogout` event handlers
   *
   * The `stateUpdater` will be passed a `User` object on successful login, or
   * `false` on logout.
   *
   * @param {function} stateUpdater - User State updater
   */
  static async initialize (stateUpdater) {
    try {
      const instance = await this.getInstance()

      instance.accounts.addEventHandlers({
        onLogin: async (gigyaUserData) => {
          try {
            await login(gigyaUserData, stateUpdater)
          } catch (error) {
            console.error(error)
          }
        },
        onLogout: async (gigyaResponse) => {
          try {
            await logout(stateUpdater)
            window.location.reload()
          } catch (error) {
            console.error(error)
          }
        }
      })
    } catch (error) {
      console.error(error)
    }

    return this
  }

  /**
   * Displays the Gigya Screenset
   *
   * The default screen set is `bark-web`. This can be overridden with the
   * `options` parameter.
   *
   * @param {Object} options - Screen Set options
   */
  static async showModal (options = {}) {
    const instance = await this.getInstance()

    instance.accounts.showScreenSet({ screenSet: 'bark-web', ...options })
  }

  /**
   * Logs out the current user from Gigya
   *
   * @param {Object} options - logout options
   */
  static async logout (options = {}) {
    const instance = await this.getInstance()

    instance.accounts.logout(options)
  }

  /**
   * Returns the Gigya object. Use this helper whenever using Gigya, since the
   * the Gigya script is loaded asynchronously.
   * @returns {Promise} Promise of the Gigya object
   */
  static getGigyaScriptObject () {
    return new Promise(resolve => {
      const script = document.createElement('script')
      script.type = 'text/javascript'
      script.async = true
      script.src = `https://cdns.gigya.com/js/gigya.js?apiKey=${window.gigyaSettings.apiKey}`
      script.text = JSON.stringify(window.gigyaSettings.modal)
      script.onload = () => resolve(window.gigya)
      document.querySelector('body').appendChild(script)
    })
  }
}

export default Gigya
