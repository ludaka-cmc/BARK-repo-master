import styled from 'styled-components'
import media from '../helpers/media'

const FormContainer = styled.div`
  max-width: 650px;
  margin: 0 16px;

  > *:first-child {
    margin-top: 0;
  }

  ${media.formLayout`
    width: 100%;
    margin: 0 auto;
  `}

`

export default FormContainer
