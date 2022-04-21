import styled from 'styled-components'

const SpacedEvenly = styled.div`
  display: flex;
  justify-content: space-evenly;
  width: 100%;

  // Fallback for browsers that don't support space-evenly
  // See https://caniuse.com/#feat=justify-content-space-evenly
  justify-content: space-around; 

  // Edge supports the rule declaration but won't actually do anything
  // See https://developer.microsoft.com/en-us/microsoft-edge/platform/issues/15947692/
  @supports (-ms-ime-align: auto) {
    justify-content: space-around;
  }
`

export default SpacedEvenly
