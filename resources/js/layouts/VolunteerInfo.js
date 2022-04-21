import React, { useState } from 'react'
import { Field } from 'react-final-form'
import { FORM_ERROR } from 'final-form'
import { H2 } from '../components/Headings'
import FormContainer from '../components/FormContainer'
import Wizard from '../components/forms/Wizard'
import InputField from '../components/forms/InputField'
import SelectField from '../components/forms/SelectField'
import ZipCodeField from '../components/forms/ZipCodeField'
import CheckboxField from '../components/forms/CheckboxField'
import LinkedList from '../components/LinkedList'
import Modal from '../components/Modal'
import SubmitCard from '../components/SubmitCard'
import Point from '../components/Point'
import TooltipContentCard from '../components/TooltipContentCard'
import { required } from '../helpers/validate'
import usStates from '../helpers/usStates'
import { post } from '../helpers/api'

const VolunteerInfo = ({ user }) => {
  const [submitted, setSubmitted] = useState(false)

  const handleSubmit = data => post('/api/volunteerinfo', data)
    .then(response => {
      setSubmitted(true)
      return undefined
    })
    .catch(error => {
      console.error(error)
      return { [FORM_ERROR]: 'Submission failed' }
    })

  return (
    <FormContainer>
      <H2>Add Volunteer Information</H2>
      <Wizard
        onSubmit={handleSubmit}
        initialValues={{
          name: user.data.name,
          email: user.data.email
        }}
      >
        <Wizard.Page>
          <Field
            name='name'
            label='Volunteer Name'
            component={InputField}
            validate={required}
            disabled
          />
          <Field
            name='address'
            component={InputField}
            label='Address'
            validate={required}
          />
          <Field
            name='city'
            component={InputField}
            label='City'
            validate={required}
          />
          <Field
            name='state'
            component={SelectField}
            label='State'
            options={usStates}
            validate={required}
          />
          <Field
            name='zipCode'
            component={ZipCodeField}
            label='Zip Code'
            minLength={5}
            validate={required}
          />
          <Field
            name='email'
            component={InputField}
            label='Email'
            validate={required}
            disabled
          />
          <Field
            name='affiliatedProgram'
            component={InputField}
            label='Affiliated Program'
          />
          <Field
            name='isCanineAmbassador'
            type='checkbox'
            component={CheckboxField}
            label='I am a Canine Ambassador'
            tooltip={{
              placement: 'right',
              tooltipContent: (
                <TooltipContentCard>
                  To enter your dog in our Reading Pals search, you must be a Canine Ambassador.
                </TooltipContentCard>
              ),
              pointContent: (<Point>?</Point>)
            }}
          />
          <LinkedList
            items={[
              { href: '//www.akc.org/privacy/', text: 'Privacy Policy' }
            ]}
          />
        </Wizard.Page>
      </Wizard>
      {
        submitted &&
        (
          <Modal>
            <SubmitCard buttons={[
              { link: '/volunteerlog', text: 'Log' },
              { link: '/dogentry', text: 'Add a New Dog' }
            ]} />
          </Modal>
        )
      }
    </FormContainer>
  )
}

export default VolunteerInfo
