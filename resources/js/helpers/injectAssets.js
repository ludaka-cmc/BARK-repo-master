import { loadCSS } from 'fg-loadcss'

const injectCSS = cssURL => {
  return new Promise((resolve, reject) => {
    const stylesheet = loadCSS(cssURL)
    stylesheet.addEventListener('load', evt => resolve(evt))
  })
}

const injectJS = jsURL => {
  return new Promise((resolve, reject) => {
    const script = document.createElement('script')
    script.type = 'text/javascript'
    script.src = jsURL
    script.async = true
    script.defer = true
    script.addEventListener('load', evt => resolve(evt))
    document.body.appendChild(script)
  })
}

export { injectCSS, injectJS }
