import styled from 'styled-components'

const Card = styled.div`
  display: flex;
  border-radius: 4px;
  padding: 16px;
  margin: 8px;
  background-color: ${props => props.theme.colors.white};
`

export default Card
