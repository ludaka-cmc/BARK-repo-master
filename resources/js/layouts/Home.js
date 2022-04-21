import React from 'react'
import styled from 'styled-components'
import { isEmpty } from 'lodash'
import Centered from '../components/Centered'
import SpacedEvenly from '../components/SpacedEvenly'
import Button from '../components/forms/Button'
import ButtonLink from '../components/ButtonLink'
import PageTextblocks from '../components/PageTextblocks'
import Gigya from '../helpers/Gigya'
import { UserConsumer } from '../components/User'

const HomeContainer = styled(Centered)`
  display: flex;
  flex-direction: column;
  align-self: center;
  padding: 0 16px;
  width: 100%;
  max-width: ${props => props.theme.limits.contentMaxWidth};
`

const TextblocksContainer = styled.div`
  margin-bottom: 32px;
  width: 100%;
`

const Home = () => {
  return (
    <HomeContainer>
      <TextblocksContainer>
        <PageTextblocks pageTitle='homepage' />
      </TextblocksContainer>
      <UserConsumer>
        {({ user }) => user.verified === null
          ? (<Button disabled>Verifying Login...</Button>)
          : !user.verified && isEmpty(user.data)
            ? (
              <Button onClick={() => Gigya.showModal()}>
                Sign In to Continue
              </Button>
            ) : (
              <SpacedEvenly>
                <ButtonLink to='readerlog'>Reader</ButtonLink>
                <ButtonLink to='volunteerlog'>Volunteer</ButtonLink>
              </SpacedEvenly>
            )
        }
      </UserConsumer>
    </HomeContainer>
  )
}

export default Home
