import React from "react";
import Authenticated from "@/Layouts/Authenticated";
import { Head, Link } from "@inertiajs/inertia-react";
import moment from "moment";

export default function Dashboard(props) {
    const { data } = props;
    const handleRefresh = (__) => {};
    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            <table className="table-auto border-collapse border w-full text-center">
                                <thead>
                                    <tr className="border">
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email Name</th>
                                        <th>Date Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {data.map((item, key) => (
                                        <tr className="border" key={key}>
                                            <td>{item.fname}</td>
                                            <td>{item.lname}</td>
                                            <td>{item.email}</td>
                                            <td>
                                                {moment
                                                    .unix(item.date)
                                                    .format(
                                                        "DD MMM YYYY hh:mm a"
                                                    )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                            <Link
                                href={route('refreshData')}
                                className="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-10 mb-10 float-right"
                            >
                                Refresh Data
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
