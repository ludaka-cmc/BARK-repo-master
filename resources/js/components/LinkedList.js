import React from 'react'
import { Link } from 'react-router-dom'
import styled from 'styled-components'
import media from '../helpers/media'

const ListItem = styled.li`
  margin: 0;

  :not(:last-of-type) {
    margin-right: 16px;
  }
`

const VerticalList = styled.ul`
  display: flex;
  list-style: none;
  padding-left: 0;
`

const HorizontalList = styled.ul`
  display: flex;
  margin-bottom: 16px;

  > *:not(:last-child) {
    margin-right: 16px;

    ${media.small`margin-right: 32px;`}
  }
`

const LinkedList = ({ items, orientation = 'vertical', ...props }) => {
  const Container = orientation === 'vertical'
    ? VerticalList
    : orientation === 'horizontal'
      ? HorizontalList
      : 'div'

  return (
    <Container {...props}>
      {
        items.map(({ text, ...props }) => (
          <ListItem key={text}>
            {props.to && (<Link {...props}>{text}</Link>)}
            {props.href && (<a {...props}>{text}</a>)}
          </ListItem>
        ))
      }
    </Container>
  )
}

export default LinkedList
