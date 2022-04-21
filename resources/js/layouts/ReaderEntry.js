import React, { useState, useEffect } from 'react'
import { matches } from 'lodash'
import { Field } from 'react-final-form'
import { H2 } from '../components/Headings'
import FormContainer from '../components/FormContainer'
import Wizard from '../components/forms/Wizard'
import InputField from '../components/forms/InputField'
import DateField from '../components/forms/DateField'
import CalendarField from '../components/forms/CalendarField'
import SelectField from '../components/forms/SelectField'
import ZipCodeField from '../components/forms/ZipCodeField'
import RadioGroupField from '../components/forms/RadioGroupField'
import HoursField from '../components/forms/HoursField'
import BookSearchField from '../components/forms/BookSearchField'
import FileField from '../components/forms/FileField'
import LinkedList from '../components/LinkedList'
import CheckboxField from '../components/forms/CheckboxField'
import Modal from '../components/Modal'
import SubmitCard from '../components/SubmitCard'
import { AgeCondition, Condition } from '../components/forms/Conditions'
import {
  required,
  maskedMinLength,
  validDate,
  validBirthday,
  composeValidators
} from '../helpers/validate'
import usStates from '../helpers/usStates'
import {
  getLocations,
  dataToOptions,
  postMultipart,
  handleSubmitError
} from '../helpers/api'
import { day } from '../helpers/time'

const ReaderEntry = () => {
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

  const handleSubmit = data => postMultipart('/api/readerlog', data)
    .then(response => {
      setSubmitted(true)
      return undefined
    })
    .catch(handleSubmitError({
      'invalid_date': { date: 'Invalid Date' },
      'invalid_birthday_date': { birthday: 'Invalid Date' }
    }))

  return (
    <FormContainer>
      <H2>Reader Visit Submission</H2>
      <Wizard onSubmit={handleSubmit}>
        <Wizard.Page>
          <Field
            name='name'
            label='Reader Name'
            component={InputField}
            validate={required}
          />
          <Field
            name='birthday'
            component={DateField}
            label='Birthday'
            placeholder='MM/DD/YYYY'
            validate={composeValidators([
              maskedMinLength(10),
              validDate,
              validBirthday
            ])}
          />
          <AgeCondition when='birthday' is={age => age < 18}>
            <Field
              name='parentGuardian'
              component={InputField}
              label='Parent/Guardian'
              validate={required}
            />
            <Field
              name='parentGuardianRelationship'
              component={InputField}
              label='Relationship to Reader'
              validate={required}
            />
            <Field
              name='parentGuardianEmail'
              component={InputField}
              label='Parent/Guardian Email'
              validate={required}
            />
          </AgeCondition>
          <AgeCondition when='birthday' unless={age => age < 18}>
            <Field
              name='email'
              component={InputField}
              label='Email'
              validate={required}
            />
          </AgeCondition>
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
            name='has_coppa'
            type='checkbox'
            component={CheckboxField}
            label='I certify that I am over the age of 18 and have the authority to submit this information'
            validate={required}
          />
        </Wizard.Page>
        <Wizard.Page>
          <Field
            name='dog'
            component={InputField}
            label='Dog Name'
            minLength={3}
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
          <Field
            name='bookRead'
            component={BookSearchField}
            label='Book Read'
            validate={required}
          />
          <Field
            name='pagesRead'
            component={InputField}
            label='Pages Read'
            validate={required}
          />
          <Field
            name='timeRead'
            component={HoursField}
            label='Time Read'
            placeholder='2.50 Hours'
            validate={maskedMinLength(10)}
          />
        </Wizard.Page>
        <Wizard.Page>
          <Field
            name='readerPhoto'
            component={FileField}
            label='Reader Photo'
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
          <LinkedList
            items={[
              { href: '//www.akc.org/terms-of-use/', text: 'Terms & Conditions' },
              { href: '//www.akc.org/privacy/', text: 'Privacy Policy' },
              { href: 'mailto:publiceducation@akc.org', text: 'Contact Us' }
            ]}
          />
        </Wizard.Page>
      </Wizard>
      {
        submitted &&
        (
          <Modal>
            <SubmitCard buttons={[
              { link: '/readerlog', text: 'Log' },
              { link: '/', text: 'Homepage' }
            ]} />
          </Modal>
        )
      }
    </FormContainer>
  )
}

export default ReaderEntry
