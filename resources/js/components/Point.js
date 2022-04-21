import styled from 'styled-components'

const Point = styled.div`
  width: 21px;
  height: 21px;
  font-size: 14px;
  border: 1.5px solid ${props => props.theme.colors.begonia};
  background-color: transparent;
  color: ${props => props.theme.colors.begonia};
  border-radius: 50%;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  line-height: 0;
  cursor: pointer;
  transition: background-color .300s cubic-bezier(.36,.89,.59,.94),
              color .300s cubic-bezier(.36,.89,.59,.94);

  &:focus,
  &:hover {
      background-color: ${props => props.theme.colors.begonia};
      color: ${props => props.theme.colors.white};
  }
`

export default Point
