import React, { useState, useEffect } from 'react'
import PropTypes from 'prop-types'
import styled from 'styled-components'
import store from '../../helpers/store'
import http from '../../helpers/http'
import { injectCSS, injectJS } from '../../helpers/injectAssets'
import componentPropType from '../../helpers/componentPropType'
import { week } from '../../helpers/time'

const Component = styled.div`
  display: ${({ show }) => show ? 'block' : 'none'};
`

const akcOrgComponentStore = store.namespace('akcOrgComponent')

const fetchAKCOrgComponent = async (componentName, store) => {
  const { data } = await http.get(
    `https://www.akc.org/wp-json/components/v1/${componentName}`
  )

  store.set(componentName, data, new Date().getTime() + week)

  return data
}

const injectAssets = ({ css, js }) => {
  const CSSMap = typeof css === 'string' ? [css] : css
  const JSMap = typeof js === 'string' ? [js] : js
  const filteredJSMap = JSMap.filter(
    jsURL => !jsURL.includes('gigya') && !jsURL.includes('addthis')
  )

  // Only CSS should hold up the markup
  filteredJSMap.map(injectJS)

  return Promise.all(CSSMap.map(injectCSS))
}

const AKCOrgComponent = ({
  ContainerEl,
  Placeholder,
  componentName,
  setRef,
  ...props
}) => {
  const [HTML, setHTML] = useState('')
  const [assetsLoaded, setAssetsLoaded] = useState(false)
  const injectComponent = async componentName => {
    const { html, assets } =
      (
        // Store.js does not seem to enforce expiry when the key was previously
        // used without expiration.
        akcOrgComponentStore.getExpiration(componentName) &&
        akcOrgComponentStore.get(componentName)
      ) || await fetchAKCOrgComponent(componentName, akcOrgComponentStore)

    setHTML(html)

    injectAssets(assets).then(() => setAssetsLoaded(true))
  }

  useEffect(() => { injectComponent(componentName) }, [])

  // Placeholder and Component must have two separate conditions since the
  // Component should not be loaded twice since components that need to run
  // hooks once will run the hook twice since the ref will be updated twice in
  // the lifecycle.
  return (
    <ContainerEl>
      {(!HTML || !assetsLoaded) && (<Placeholder />)}
      {
        HTML && (
          <Component
            dangerouslySetInnerHTML={{ __html: HTML }}
            show={assetsLoaded}
            ref={setRef}
            {...props}
          />
        )
      }
    </ContainerEl>
  )
}

AKCOrgComponent.propTypes = {
  ContainerEl: componentPropType,
  Placeholder: componentPropType,
  componentName: PropTypes.string,
  setRef: PropTypes.func
}

AKCOrgComponent.defaultProps = {
  Placeholder: 'div'
}

export default AKCOrgComponent
