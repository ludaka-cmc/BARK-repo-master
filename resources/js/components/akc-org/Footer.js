import React from 'react'
import styled from 'styled-components'
import AKCOrgComponent from './AKCOrgComponent'
import FooterPlaceholder from '../placeholders/FooterPlaceholder'

const MarginedFooter = styled.footer`
  margin-top: 40px;
`

const Footer = () => (
  <AKCOrgComponent
    componentName='footer'
    ContainerEl={MarginedFooter}
    Placeholder={FooterPlaceholder}
  />
)

export default Footer
