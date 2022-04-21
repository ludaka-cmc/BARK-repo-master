import React, { useState, useEffect } from 'react'
import LogContainer from '../components/LogContainer'
import VolunteerLogTable from '../components/tables/VolunteerLogTable'
import VolunteerSummaryTable from '../components/tables/VolunteerSummaryTable'
import LinkedList from '../components/LinkedList'
import { H2, H3 } from '../components/Headings'
import { getLogs, getVolunteers } from '../helpers/api'
import { second, day } from '../helpers/time'
import { mode } from '../helpers/math'
import { isEmpty } from 'lodash'

const formLinks = {
  dogEntry: { to: '/dogentry', text: 'Add a New Dog' },
  volunteerVisit: { to: '/volunteerentry', text: 'Add a New Visit' },
  volunteerInfo: { to: '/volunteerinfo', text: 'Add Volunteer Info' }
}

const VolunteerLog = props => {
  const { user } = props

  const [links, setLinks] = useState([])
  useEffect(() => {
    getVolunteers(user.data.id, day)
      .then(data => setLinks(data.id
        ? [formLinks.dogEntry, formLinks.volunteerVisit]
        : [formLinks.volunteerInfo]
      ))
  }, [])

  const [isLoading, setIsLoading] = useState(true)
  const [logs, setLogs] = useState([])
  useEffect(() => {
    getLogs('volunteer', user.data.id, second * 5)
      .then(logs => {
        const logData = logs.map(log => {
          const date = new Date(log.log_date.replace(' ', 'T'))

          return {
            name: log.dog.name,
            date: `${date.getMonth() + 1}/${date.getDate()}/${date.getFullYear()}`,
            location: log.location.description,
            studentsTotal: log.studentnum.description,
            studentsAges: log.studentage.description,
            photo: log.media && log.media.url
          }
        })

        setLogs(logData)

        setIsLoading(false)
      })
  }, [])

  const [summary, setSummary] = useState([{
    readingEvents: 0,
    studentAgeMode: '',
    studentLocationMode: ''
  }])
  useEffect(() => {
    if (isEmpty(logs)) return

    const ages = logs.map(log => log.studentsAges)
    const locations = logs.map(log => log.location)

    const summaryData = {
      readingEvents: logs.length,
      studentAgeMode: mode(ages),
      studentLocationMode: mode(locations)
    }

    setSummary([summaryData])
  }, [logs])

  return (
    <LogContainer {...props}>
      <H2>Volunteer Log</H2>
      <LinkedList items={links} />
      <H3>Previous Visits</H3>
      <VolunteerLogTable data={logs} loading={isLoading} />
      <H3>Summary</H3>
      <VolunteerSummaryTable data={summary} />
    </LogContainer>
  )
}

export default VolunteerLog
