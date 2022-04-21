import styled from 'styled-components'
import media from '../helpers/media'

const LogContainer = styled.div`
  max-width: 960px;
  width: 100%;
  padding: 0 16px;

  > *:first-child {
    margin-top: 0;
  }

  ${media.logLayout`
    margin: 0 auto;
  `}
`

export default LogContainer
