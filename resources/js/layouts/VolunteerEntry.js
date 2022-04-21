import React, { useState, useEffect } from 'react'
import { matches } from 'lodash'
import { Field } from 'react-final-form'
import { H2 } from '../components/Headings'
import FormContainer from '../components/FormContainer'
import Wizard from '../components/forms/Wizard'
import InputField from '../components/forms/InputField'
import AsyncSelectField from '../components/forms/AsyncSelectField'
import CalendarField from '../components/forms/CalendarField'
import RadioGroupField from '../components/forms/RadioGroupField'
import FileField from '../components/forms/FileField'
import CheckboxField from '../components/forms/CheckboxField'
import Modal from '../components/Modal'
import SubmitCard from '../components/SubmitCard'
import { Condition } from '../components/forms/Conditions'
import { required } from '../helpers/validate'
import { second, day } from '../helpers/time'
import {
  getLocations,
  getStudentAges,
  getStudentNums,
  dataToOptions,
  postMultipart,
  handleSubmitError
} from '../helpers/api'

const VolunteerEntry = ({ user }) => {
  const [submitted, setSubmitted] = useState(false)

  const [locations, setLocations] = useState([])
  const [otherID, setOtherID] = useState('')
  useEffect(() => {
    getLocations(day).then(locations => {
      const [other] = locations.filter(matches({ title: 'other' }))

      if (other && other.id) setOtherID(other.id.toString())

      setLocations(dataToOptions(locations))
    })
  }, [])

  const [studentAges, setStudentAges] = useState([])
  useEffect(() => {
    getStudentAges(day)
      .then(studentAges => setStudentAges(dataToOptions(studentAges)))
  }, [])

  const [studentNums, setStudentNums] = useState([])
  useEffect(() => {
    getStudentNums(day)
      .then(studentNums => setStudentNums(dataToOptions(studentNums)))
  }, [])

  const handleSubmit = data => postMultipart('/api/volunteerlog', data)
    .then(response => {
      setSubmitted(true)
      return undefined // undefined = success
    })
    .catch(handleSubmitError({ 'invalid_date': { date: 'Invalid Date' } }))

  return (
    <FormContainer>
      <H2>Add a New Visit</H2>
      <Wizard onSubmit={handleSubmit}>
        <Wizard.Page>
          <Field
            name='dog'
            label='Dog Name'
            component={AsyncSelectField}
            request={{
              url: '/api/dogs',
              cacheKey: 'dogs',
              cacheTime: second * 5,
              optionMapper: dogs => dogs
                .filter(matches({ volunteer: { user_id: user.data.id } }))
                .map(dog => ({ value: dog.id, label: dog.name }))
            }}
            validate={required}
          />
          <Field
            name='date'
            component={CalendarField}
            label='Date of Visit'
            placeholder='MM/DD/YYYY'
            validate={required}
          />
          <RadioGroupField
            name='location'
            label='Location of Visit'
            options={locations}
          />
          {
            otherID && (
              <Condition when='location' is={otherID}>
                <Field
                  name='otherLocation'
                  component={InputField}
                  label='Other Location'
                  validate={required}
                />
              </Condition>
            )
          }
          <RadioGroupField
            name='numberOfReaders'
            label='Number of Readers'
            options={studentNums}
          />
          <RadioGroupField
            name='ageOfReaders'
            label='Age of Readers'
            options={studentAges}
          />
          <Field
            name='dogPhoto'
            component={FileField}
            label='Dog Photo'
            accept='image/*'
          />
          <div>
            <a
              href='//akcbark.s3.amazonaws.com/pdf/person-dog-release.pdf'
              target='_blank'
            >
              Release Form
            </a>
          </div>
          <Field
            name='releaseFormAgree'
            type='checkbox'
            component={CheckboxField}
            label='I Agree to the Release Form'
            validate={required}
          />
        </Wizard.Page>
      </Wizard>
      {
        submitted &&
        (
          <Modal>
            <SubmitCard buttons={[
              { link: '/volunteerlog', text: 'Log' },
              { link: '/', text: 'Homepage' }
            ]} />
          </Modal>
        )
      }
    </FormContainer>
  )
}

export default VolunteerEntry
