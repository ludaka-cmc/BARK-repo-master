import React from 'react'
import styled from 'styled-components'
import ContentLoader from 'react-content-loader'
import media from '../../helpers/media'

const Container = styled.div`
  width: 60px;
  height: 17px;
  margin-right: 15px;

  ${media.large`
    margin-right: 32px;
  `}
`

const LoginPlaceholder = () => (
  <Container>
    <ContentLoader
      height='17'
      width='60'
    >
      <rect x='0' y='0' rx='4' ry='4' width='60' height='17' />
    </ContentLoader>
  </Container>
)

export default LoginPlaceholder
