import React, { useState, useEffect } from 'react'
import styled from 'styled-components'
import { Field } from 'react-final-form'
import { H2 } from '../components/Headings'
import FormContainer from '../components/FormContainer'
import Wizard from '../components/forms/Wizard'
import InputField from '../components/forms/InputField'
import AsyncSelectField from '../components/forms/AsyncSelectField'
import FileField from '../components/forms/FileField'
import CheckboxField from '../components/forms/CheckboxField'
import CheckboxGroupField from '../components/forms/CheckboxGroupField'
import Point from '../components/Point'
import Modal from '../components/Modal'
import TooltipContentCard from '../components/TooltipContentCard'
import SubmitCard from '../components/SubmitCard'
import { required } from '../helpers/validate'
import { minute } from '../helpers/time'
import {
  getCertifications,
  dataToOptions,
  postMultipart,
  handleSubmitError
} from '../helpers/api'

const TooltipLink = styled.a`
  > :first-child {
    margin-top: 0;
  }

  > :last-child {
    margin-bottom: 0;
  }
`

const DogEntry = () => {
  const [submitted, setSubmitted] = useState(false)

  const [certifications, setCertifications] = useState([])
  useEffect(() => {
    getCertifications(minute * 15)
      .then(certs => setCertifications(
        dataToOptions(certs, (option, value) => ({
          ...option,
          tooltip: {
            placement: 'right',
            tooltipContent: (
              <TooltipContentCard>
                {
                  value.tooltip_text
                    ? (
                      <TooltipLink
                        href={value.url}
                        dangerouslySetInnerHTML={{ __html: value.tooltip_text }}
                      />
                    ) : (<TooltipLink href={value.url}>More Info</TooltipLink>)
                }
              </TooltipContentCard>
            ),
            pointContent: (<Point>?</Point>),
            interactive: true
          }
        }))
      ))
  }, [])

  const handleSubmit = data => postMultipart('/api/dogs', data)
    .then(response => {
      setSubmitted(true)
      return undefined
    })
    .catch(handleSubmitError({
      'duplicate_registration_code': {
        registrationNumber: 'Registration number already'
      }
    }))

  return (
    <FormContainer>
      <H2>Add a New Dog</H2>
      <Wizard onSubmit={handleSubmit}>
        <Wizard.Page>
          <Field
            name='name'
            label='Dog Name'
            component={InputField}
            validate={required}
          />
          <Field
            name='breed'
            label='Dog Breed'
            component={AsyncSelectField}
            request={{
              url: '/api/breeds',
              cacheKey: 'breeds',
              optionMapper: breeds => breeds.map(breed => ({
                value: breed.id,
                label: breed.breed_name_display
              }))
            }}
            validate={required}
          />
          <Field
            name='registrationNumber'
            label='Registration Number'
            component={InputField}
          />
          <CheckboxGroupField
            name='certifications'
            label='Certifications'
            defaultFields={certifications}
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

export default DogEntry
