import React from 'react'
import styled from 'styled-components'

const ModalContainer = styled.div`
  position: fixed;
  top: 0;
  left: 0;
  z-index: 100000;
  height: 100vh;
  width: 100vw;
  background-color: rgba(8,0,16,0.7)
`

const StyledModal = styled.div`
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  max-width: 100%;
  max-height: 100%;
`

const Modal = ({ containerProps, ...props }) => (
  <ModalContainer {...containerProps}>
    <StyledModal {...props} />
  </ModalContainer>
)

export default Modal
