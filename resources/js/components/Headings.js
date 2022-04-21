import styled from 'styled-components'

import media from '../helpers/media'

const H1 = styled.h1`
  ${props => props.theme.typography.merriweatherBold}
  color: ${props => props.theme.colors.akcBlue};
  font-size: 39px;

  ${media.small`
    font-size: 61px;
  `}
`

const H2 = styled.h2`
  ${props => props.theme.typography.merriweatherReg}
  color: ${props => props.theme.colors.akcBlue};
  font-size: 31px;

  ${media.small`
    font-size: 39px;
  `}
`

const H3 = styled.h3`
  ${props => props.theme.typography.latoReg}
  color: props.theme.colors.akcBlue;
  font-size: 25px;

  ${media.small`
    font-size: 31px;
  `}
`

export { H1, H2, H3 }
