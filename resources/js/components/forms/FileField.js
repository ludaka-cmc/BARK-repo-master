import React, { Component } from 'react'
import styled from 'styled-components'
import { merge } from 'lodash'
import Dropzone from 'react-dropzone'
import Label from './Label'
import { WizardConsumer } from './Wizard'

const FileFieldContainer = styled.div`
  display: flex;
  flex-direction: column;
  border-radius: 4px;
`

const FileDropContainer = styled.div`
  display: flex;
  flex-direction: column;
  padding: 16px;
  width: 280px;
  height: 280px;
  background-color: ${props => props.theme.colors.gray};
  box-shadow: 0 0 1px 1px ${props => props.isDragActive ? props.theme.colors.akcBrightBlue : 'transparent'};
`

const FileDropText = styled.p`
  text-align: center;
`

const FileDropContent = styled.div`
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100%;
  width: 100%;
`

const Thumbnail = styled.img`
  max-width: 200px;
  max-height: 175px;
  height: auto;
`

class FileField extends Component {
  constructor () {
    super()
    this.handleDrop = this.handleDrop.bind(this)
    this.state = {
      files: [],
      formAPI: null
    }
  }

  componentWillUnmount () {
    this.state.files.forEach(file => URL.revokeObjectURL(file.preview))
  }

  handleDrop (files) {
    this.state.formAPI.change(this.props.input.name, files[0])
    this.setState({
      files: files.map(file => merge(file, {
        preview: URL.createObjectURL(file)
      }))
    })
  }

  renderThumbnails (file) {
    return (
      <Thumbnail src={file.preview} />
    )
  }

  render () {
    const { input: { name }, meta, label, accept } = this.props
    const { files } = this.state
    const labelProps = meta.error && meta.touched
      ? { status: 'error', statusText: meta.error }
      : {}

    return (
      <FileFieldContainer>
        <WizardConsumer>
          {value => {
            if (value.formAPI) this.state.formAPI = value.formAPI
          }}
        </WizardConsumer>
        <Label htmlFor={name} {...labelProps}>{label}</Label>
        <Dropzone
          maxSize={2 * 1000 * 1000} // 2 MB Nginx default file upload max
          onDropAccepted={this.handleDrop}
          accept={accept}
        >
          {({ getRootProps, getInputProps, isDragActive }) => {
            return (
              <FileDropContainer {...getRootProps()} isDragActive={isDragActive}>
                <input
                  {...getInputProps()}
                  name={name}
                  id={name}
                />
                <FileDropText>
                  Click or Drag to Upload an Image (max size is 2MB)
                </FileDropText>
                <FileDropContent>
                  {!files && isDragActive && <p>Drop files here...</p>}
                  <div>
                    {
                      files.map(file => (
                        <div key={file.name}>
                          {this.renderThumbnails(file)}
                        </div>
                      ))
                    }
                  </div>
                </FileDropContent>
              </FileDropContainer>
            )
          }}
        </Dropzone>
      </FileFieldContainer>
    )
  }
}

export default FileField
