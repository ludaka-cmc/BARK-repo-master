import React, { useState, useEffect } from 'react'
import Calendar from 'react-calendar'
import styled from 'styled-components'
import { WizardConsumer } from './Wizard'
import Label from './Label'
import { inputStyles } from './InputField'
import { onClickOut } from '../../helpers/events'

const PopupCalendar = styled(Calendar)`
  position: absolute;
  border-radius: 4px;
  z-index: 10;

  .react-calendar__month-view__days__day--weekend {
    color: black;
  }
`

const Input = styled.input`${inputStyles}`

const addLeadingZero = numStr => parseInt(numStr) < 10 ? `0${numStr}` : numStr

const CalendarField = ({
  input: { name, ...input },
  meta,
  label,
  ...props
}) => {
  const [mutators, setMutators] = useState(null)
  const [toggled, setToggled] = useState(false)
  const [date, setDate] = useState(null)
  const labelProps = (meta.error && meta.touched) || (meta.submitError)
    ? { status: 'error', statusText: meta.error || meta.submitError }
    : {}

  useEffect(() => {
    if (toggled) {
      onClickOut(`#${name}-container`, () => setToggled(false))
    }
  }, [toggled])

  useEffect(() => {
    if (!mutators || !mutators.setValue) return

    mutators.setValue(
      name,
      `${addLeadingZero(date.getMonth() + 1)}/${addLeadingZero(date.getDate())}/${date.getFullYear()}`
    )

    setToggled(false)
  }, [date])

  return (
    <div
      id={`${name}-container`}
      onClick={() => setToggled(true)}
    >
      {!mutators && (
        <WizardConsumer>
          {({ formAPI }) => {
            if (formAPI.mutators) setMutators(formAPI.mutators)
          }}
        </WizardConsumer>
      )}

      <Label htmlFor={name} {...labelProps}>{label}</Label>
      <Input
        name={name}
        id={name}
        autoComplete='off'
        readOnly
        {...input}
        {...props}
      />
      {toggled && (
        <PopupCalendar
          calendarType='US'
          minDetail='month'
          maxDate={new Date()}
          onClickDay={setDate}
          value={date}
        />
      )}
    </div>
  )
}

export default CalendarField
