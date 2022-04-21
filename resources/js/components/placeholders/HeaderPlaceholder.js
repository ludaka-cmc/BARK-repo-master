import React from 'react'
import ContentLoader from 'react-content-loader'

const HeaderPlaceholder = () => (
  <ContentLoader
    height='115'
    width='1440'
  >
    <rect x='32' y='20' rx='4' ry='4' width='275' height='120' />

    <rect x='580' y='40' rx='4' ry='4' width='100' height='20' />
    <rect x='710' y='40' rx='4' ry='4' width='100' height='20' />
    <rect x='830' y='40' rx='4' ry='4' width='100' height='20' />
    <rect x='960' y='40' rx='4' ry='4' width='100' height='20' />
    <rect x='1090' y='40' rx='4' ry='4' width='100' height='20' />
    <rect x='1240' y='40' rx='4' ry='4' width='150' height='20' />

    <rect x='450' y='80' rx='4' ry='4' width='140' height='27' />
    <rect x='640' y='80' rx='4' ry='4' width='140' height='27' />
    <rect x='830' y='80' rx='4' ry='4' width='140' height='27' />
    <rect x='1020' y='80' rx='4' ry='4' width='140' height='27' />
    <rect x='1220' y='80' rx='4' ry='4' width='140' height='27' />
  </ContentLoader>
)

export default HeaderPlaceholder
