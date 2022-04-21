import styled from 'styled-components'

const SiteContainer = styled.div`
  display: flex;
  flex-direction: column;
  max-width: ${props => props.theme.limits.componentMaxWidth};
  margin: 0 auto;

  * {
    box-sizing: border-box;
  }
`

export default SiteContainer
