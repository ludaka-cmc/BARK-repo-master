import React, { useState, useEffect } from 'react'
import styled from 'styled-components'
import TextblockPlaceholder from './placeholders/TextblockPlaceholder'
import { getPages, getTextblocks } from '../helpers/api'
import { minute } from '../helpers/time'

const Textblock = styled.div`
  > *:first-child {
    margin-top: 0;
    padding-top: 0;
  }

  > *:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
  }
`

const getHomepageTextblocks = async (pageTitle) => {
  const data = await getPages(pageTitle, minute * 15)

  return getTextblocks(data.id, minute)
}

const Textblocks = ({ pageTitle }) => {
  const [textblocks, setTextblocks] = useState([])
  useEffect(() => {
    getHomepageTextblocks(pageTitle).then(setTextblocks)
  }, [])

  return textblocks.length > 0
    ? textblocks.map(({ id, text }) => (
      <Textblock key={id} dangerouslySetInnerHTML={{ __html: text }} />
    ))
    : (<TextblockPlaceholder />)
}

export default Textblocks
