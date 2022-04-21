import React, { Component } from 'react'
import styled from 'styled-components'
import { Form } from 'react-final-form'
import Button from './Button'

const StyledForm = styled.form`
  > *:not(:last-child) {
    padding-bottom: 8px;
  }
`

const ButtonGroup = styled.div`
  display: flex;
  padding-top: 8px;

  > button:not(:last-of-type) {
    margin-right: 16px;
  }
`

const ErrorText = styled.p`
  ${props => props.theme.typography.latoBold};
  color: ${props => props.theme.colors.failure};
`

// We can't pass down the Form props normally through the Children since the
// Wizard pages are built dynamically. Using a Context to allow children to
// access Form props
const {
  Provider: WizardProvider,
  Consumer: WizardConsumer
} = React.createContext({ formAPI: null })

class Wizard extends Component {
  static Page = ({ children }) => children

  constructor (props) {
    super(props)
    this.state = {
      page: 0,
      values: props.initialValues || {}
    }
  }

  next = values => this.setState(state => ({
    page: Math.min(state.page + 1, this.props.children.length - 1),
    values
  }))

  previous = () => this.setState(state => ({
    page: Math.max(state.page - 1, 0)
  }))

  validate = values => {
    const activePage = React.Children.toArray(this.props.children)[this.state.page]
    return activePage.props.validate ? activePage.props.validate(values) : {}
  }

  handleSubmit = values => {
    const { children, onSubmit } = this.props
    const { page } = this.state
    const isLastPage = page === React.Children.count(children) - 1

    if (isLastPage) {
      return onSubmit(values)
    } else {
      this.next(values)
    }
  }

  render () {
    const { children } = this.props
    const { page, values } = this.state
    const activePage = React.Children.toArray(children)[page]
    const isLastPage = page === React.Children.count(children) - 1

    return (
      <Form
        mutators={{
          setValue: ([field, value], state, { changeValue }) => {
            changeValue(state, field, () => value)
          }
        }}
        initialValues={values}
        validate={this.validate}
        onSubmit={this.handleSubmit}
      >
        {({ handleSubmit, submitting, values, form, submitError }) => (
          <WizardProvider value={{ formAPI: form }}>
            <StyledForm onSubmit={handleSubmit}>
              {activePage}
              <ButtonGroup>
                {isLastPage && submitError && (
                  <ErrorText>{submitError}</ErrorText>
                )}
                {page > 0 && (
                  <Button type='button' onClick={this.previous}>
                    Previous
                  </Button>
                )}
                {
                  isLastPage ? (
                    <Button type='submit' disabled={submitting}>
                      {submitting ? 'Submitting...' : 'Submit'}
                    </Button>
                  ) : (<Button type='submit'>Next</Button>)
                }
              </ButtonGroup>
            </StyledForm>
          </WizardProvider>
        )}
      </Form>
    )
  }
}

export { WizardConsumer }

export default Wizard
