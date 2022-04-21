import styled from 'styled-components'
import Card from './Card'

const TooltipContentCard = styled(Card)`
  background-color: ${props => props.theme.colors.begonia};
  color: ${props => props.theme.colors.white};
  box-shadow: 0 2px 6px 0 rgba(0,0,0,0.5);
`

export default TooltipContentCard
