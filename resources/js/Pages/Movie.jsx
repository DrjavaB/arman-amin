import {Head} from '@inertiajs/react';
import {useEffect, useState} from "react";
import {useDebounce} from 'usehooks-ts'
import Pagination from "@/Components/Pagination.jsx";
import Album from "@/Components/Album.jsx";

export default function Movie() {
    const [name, setName] = useState('')
    const [page, setPage] = useState(1)
    const [list, setList] = useState({})
    const debouncedValue = useDebounce(name, 500);
    useEffect(() => {
        axios.get('/api/movie', {
            params: {
                name,
                page
            }
        }).then(res => setList(res.data)).catch(e => console.log(e.response))
    }, [debouncedValue, page])

    return list.data && (
        <>
            <Head title="Welcome"/>
            <div className='mx-3 md:mx-0 mb-4'>
                <div className='md:w-3/4 xl:w-1/2 mt-3 mx-auto'>
                    <div
                        className="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <form>
                            <label htmlFor="default-search"
                                   className="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div className="relative">
                                <div className="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" className="w-5 h-5 text-gray-500 dark:text-gray-400"
                                         fill="none"
                                         stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="search" id="default-search"
                                       className="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Search Movies" required
                                       value={name}
                                       onChange={event => setName(event.target.value)}
                                />
                            </div>
                        </form>
                    </div>
                    <div>
                        {list.data?.length > 0 &&
                            <ul className="mt-3 px-2 divide-y divide-gray-200 dark:divide-gray-700">
                                {list.data.map(item => (
                                    <li key={item.id} className="p-3">
                                        <div className="flex items-center space-x-4">
                                            <div className="flex-shrink-0">
                                                <img className="w-16 h-16 object-cover rounded-full"
                                                     src={item.poster} alt={item.title}/>
                                            </div>
                                            <div className="flex-1 min-w-0">
                                                <p className="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    {item.title}
                                                </p>
                                                <div className="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    <ul className='flex space-x-3'>
                                                        <li><span className='font-bold'>year:</span> {item.year}</li>
                                                        <li><span className='font-bold'>country:</span> {item.country}
                                                        </li>
                                                        <li><span
                                                            className='font-bold'>imdb_rating:</span> {item.imdb_rating}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div>
                                                    {item.genres.map((item, index) => (
                                                        <a key={index} href={'#' + item}
                                                           className='pr-1 text-sm text-gray-500'>#{item}</a>
                                                    ))}
                                                </div>
                                            </div>
                                            <div className='w-32'>
                                                {item?.images?.length ?
                                                    <Album list={item.images}/>
                                                    : <p className='text-gray-300 text-center'>No Data</p>
                                                }
                                            </div>
                                        </div>
                                    </li>
                                ))}
                            </ul>
                        }
                    </div>
                    <div>
                        <Pagination
                            metadata={list?.metadata}
                            setPage={setPage}
                        />
                    </div>
                </div>
            </div>
        </>
    );
}
