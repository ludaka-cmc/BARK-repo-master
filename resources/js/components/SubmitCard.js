import React from 'react'
import styled from 'styled-components'
import { H3 } from './Headings'
import ButtonLink from './ButtonLink'

const Container = styled.div`
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  max-width: 100%;
  width: 360px;
  padding: 16px;
  background-color: ${props => props.theme.colors.white};
  border-radius: 4px;
`

const Heading = styled(H3)`
  margin-top: 0px;
  margin-bottom: 0px;
`

const ButtonGroup = styled.div`
  display: flex;
  width: 100%;

  > ${ButtonLink}:not(:last-of-type) {
    margin-right: 16px;
  }
`

const Card = ({ buttons = [] }) => (
  <Container>
    <Heading>Thank You</Heading>
    <p>Your info has been added</p>
    {
      buttons && (
        <ButtonGroup>
          {buttons.map(({ link, text }) => (
            <ButtonLink key={link} to={link} fullWidth>{text}</ButtonLink>
          ))}
        </ButtonGroup>
      )
    }
  </Container>
)

export default Card
